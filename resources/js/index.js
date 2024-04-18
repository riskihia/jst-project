let cellTables = document.querySelectorAll(".sell-tabel");

cellTables.forEach((e) => {
    e.addEventListener("click", function () {
        console.log(e.classList);
        e.classList.toggle("bg-gray-50");
        e.classList.toggle("bg-red-300");

        const checkbox = this.querySelector(".cell-checkbox");
        checkbox.checked = !checkbox.checked;
    });
});
