<!-- モーダルウィンドウのHTML -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span id="close-modal" class="close">&times;</span>
        <h2>詳細情報</h2>
        <div id="modal-body">
<script>
    // モーダルを開く
    function openModal(contactId) {
        // モーダルを表示
        document.getElementById("modal").style.display = "block";

        // 詳細情報をサーバーから非同期で取得
        fetch('/admin/contact/' + contactId)  // 例えば詳細ページのAPIエンドポイント
            .then(response => response.json())
            .then(data => {
                // モーダルの中に詳細情報を挿入
                document.getElementById("modal-body").innerHTML = `
                    <p><strong>お名前:</strong> ${data.name}</p>
                    <p><strong>性別:</strong> ${data.gender_label}</p>
                    <p><strong>メールアドレス:</strong> ${data.email}</p>
                    <p><strong>電話番号:</strong> ${data.tel1}-${data.tel2}-${data.tel3}</p>
                    <p><strong>住所:</strong> ${data.address}</p>
                    <p><strong>建物:</strong> ${data.building}</p>
                    <p><strong>お問い合わせの種類:</strong> ${data.detail}</p>
                    <p><strong>お問い合わせの内容:</strong> ${data.content}</p>
                `;
            });
    }

    // モーダルを閉じる
    document.getElementById("close-modal").onclick = function() {
        document.getElementById("modal").style.display = "none";
    }

    // モーダル外をクリックしたら閉じる
    window.onclick = function(event) {
        if (event.target === document.getElementById("modal")) {
            document.getElementById("modal").style.display = "none";
        }
    }
</script>
        </div>
    </div>
</div>
