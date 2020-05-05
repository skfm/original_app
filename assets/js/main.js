// インデックスページのクリップボードのコピー
function copyToClipboard() {
  const text = document.getElementById("copyTarget").innerText;
  const area = document.createElement("textarea");
  area.textContent = text;
  document.body.appendChild(area);
  area.select();
  document.execCommand("copy");
  document.body.removeChild(area);
  alert("コピー完了！");
}
