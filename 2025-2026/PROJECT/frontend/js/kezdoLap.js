fetch("../backend/user.php", {
    headers: {
        Authorization: localStorage.getItem("token"),
    },
})
    .then((r) => r.json())
    .then((d) => {
        if (d.success) {
            console.log(d);
        }
    });
