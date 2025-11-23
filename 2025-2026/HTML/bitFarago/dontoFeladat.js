//Az egész egy greedy algoritmus legyen az bármi

fetch("elsoPalya.json")
    .then((r) => r.json())
    .then((json) => {
        const answers = {};
        answers["7"] = solveBasicMiningTask(json.data.questions[0].params);
        answers["8"] = solveBasicMiningTask(json.data.questions[1].params);
        answers["9"] = solveBasicMiningTask(json.data.questions[2].params);
        answers["10"] = solveBasicMiningTask(json.data.questions[3].params);
        console.log(answers);
    });

function solveBasicMiningTask(params) {
    //hajók obj létrehozása ez még megy
    const ship = {
        capacity: 25,
        speed: 10,
        miningRate: 15,
    };

    const positions = params.positions; //összes kordináta eltárolása mindegy hoz base vagy aszteroida
    const N = positions.length; //hány darab dolog van
    const baseIndex = positions.findIndex((p) => p.type === "Base"); //megkeresi a positionsban hol van a base és visszaadja a positionban az indexét

    const dist = Array.from({ length: N }, () => Array(N).fill(0)); //ez a kis cuksiság léterhoz egy N*N-es mátrixot(több dimenziós tömb) ahol az N az hogy hány aszteroida és base van Array.from létrehoz egy tömböt({ length: N } ilyen hosszúsággal, () => Array(N).fill(0) ez meg vissza ad egy másik tömböt a tömbe aminek az eleme 0 hogy legyen benne cska valami)
    for (let i = 0; i < N; i++) {
        for (let j = 0; j < N; j++) {
            const dx = positions[i].x - positions[j].x;
            const dy = positions[i].y - positions[j].y;
            dist[i][j] = Math.ceil(Math.hypot(dx, dy)); //beépített dolog 2d pontok távolságának kiszámítására majd a megfelelő helyre berakni
        }
    } //kiszámolja a távolságokat
    //console.table(dist); //Geci hasznos dolog

    const movementRounds = (from, to) => Math.ceil(dist[from][to] / ship.speed); //gyakorlatilag egy fügvényt definiál ami azt számolja ki hogy a hajó hény kör alat jut el A-ból B-be pl from = 2 to = 5 akkor az dist[2][5] távolsága majd a hajó sebességével(10) osztva megkapjuk a körök számát de kell a Math.ceil mert pl 3.6 kör nincs

    const remaining = positions.map((p) => (p.type === "Asteroid" ? p.quantity : 0)); //megadja az aszteroidákon maradt ércek számát ha nem aszteroida akkor nulla lesz a helyén
    //console.log(remaining);

    //Itt fogyott el a ChatGPT

    function nearestAsteroid(from) {
        let best = -1;
        let bestD = Infinity;
        for (let i = 0; i < N; i++) {
            if (remaining[i] > 0) {
                const d = dist[from][i];
                if (d < bestD) {
                    bestD = d;
                    best = i;
                }
            }
        }
        return best;
    }

    function nearestBase(from) {
        let best = -1;
        let bestD = Infinity;
        for (let i = 0; i < N; i++) {
            if (positions[i].type === "Base") {
                const d = dist[from][i];
                if (d < bestD) {
                    bestD = d;
                    best = i;
                }
            }
        }
        return best;
    }

    // BUILD COMMAND LIST
    const commands = [];
    commands.push({ command: "STARTFROM", position: baseIndex });

    let current = baseIndex;
    let cargo = 0;
    let totalRounds = 0;
    let totalMined = 0;

    while (true) {
        const target = nearestAsteroid(current);
        if (target === -1) break;

        // MOVE to asteroid
        const moveR = movementRounds(current, target);
        if (moveR > 0) {
            commands.push({ command: "MOVE", position: target });
            totalRounds += moveR;
            current = target;
        }

        // MINE until empty or ship full
        while (remaining[target] > 0 && cargo < ship.capacity) {
            const extractable = Math.min(remaining[target], ship.capacity - cargo);
            const rounds = Math.ceil(extractable / ship.miningRate);

            commands.push({ command: "MINE", rounds });
            totalRounds += rounds;

            const mined = Math.min(extractable, rounds * ship.miningRate);

            remaining[target] -= mined;
            cargo += mined;
            totalMined += mined;

            if (cargo >= ship.capacity) break;
        }

        // RETURN to nearest base if carrying ore
        if (cargo > 0) {
            const bi = nearestBase(current);
            const moveBack = movementRounds(current, bi);
            if (moveBack > 0) {
                commands.push({ command: "MOVE", position: bi });
                totalRounds += moveBack;
            }
            current = bi;
            cargo = 0; // unloading is instant
        }
    }

    // FINISH AT BASE
    if (positions[current].type !== "Base") {
        const bi = nearestBase(current);
        const mR = movementRounds(current, bi);
        if (mR > 0) {
            commands.push({ command: "MOVE", position: bi });
            totalRounds += mR;
            current = bi;
        }
    }

    return {
        commands: [commands],
        totalRounds,
        totalMined,
    };
}
