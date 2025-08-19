// モーダルの要素を取得
// HTMLでid="myModal"のタグを用意しておくこと
var modal = document.getElementById("myModal");

// モーダルを開く
function openModal() {
    modal.style.display = "block";
}

// モーダルを閉じる
function closeModal() {
    modal.style.display = "none";
}

// モーダルの外側をクリックすると閉じる
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
