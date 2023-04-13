const a = document.querySelectorAll(".list_btn");
for (let i in a) {
    a[i].addEventListener("click", function (event) {
        if (!window.confirm("本当に削除しますか？")) {
            event.preventDefault(); // デフォルト動作を中止
        }
    });
}

