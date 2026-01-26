function leKer() {
    fetch("../backend/request/db_stats_request.php", {
        method: "POST",
    })
        .then((r) => r.json())
        .then((d) => {
            if (d.success) {
                teacherNumber.innerHTML = d.tanarDb;
                studentNumber.innerHTML = d.diakDb;
            }
        });
}
