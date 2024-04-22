<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Edit Theme</title>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
    <h1>Add/Edit Theme</h1>
    <form id="themeForm">
        <label for="themeName">Name of your theme :</label>
        <input type="text" id="themeName" required><br><br>
        
        <label for="backgroundColor">Color of Page Background:</label>
        <input type="color" id="backgroundColor" value="#ffffff"><br><br>
        
        <label for="headingColor">Color of Heading 1:</label>
        <input type="color" id="headingColor" value="#000000"><br><br>
        
        <label for="headingAlignment">Alignment of Heading 1:</label>
        <select id="headingAlignment">
            <option value="choose">--Choose the Alignment--</option>
            <option value="left">Left</option>
            <option value="center">Center</option>
            <option value="right">Right</option>
        </select><br><br>
        
        <label for="paragraphColor">Color of Paragraph :</label>
        <input type="color" id="paragraphColor" value="#000000"><br><br>
        
        <label for="fontSize">Font size of Paragraph:</label>
        <input type="number" id="fontSize" value="">
        <label for="px">px</label><br><br>
        
        <button type="button" onclick="saveSettings()">Save</button>
    </form>

    <script>
        // Fungsi untuk mengisi formulir dengan pengaturan tema yang ada saat halaman dimuat
        function fillFormWithThemeSettings() {
            var urlParams = new URLSearchParams(window.location.search);
            var themeName = urlParams.get('theme');
            if (themeName) {
                var cookieValue = getCookie("themeSettings_" + themeName);
                if (cookieValue) {
                    var themeSettings = JSON.parse(cookieValue);
                    document.getElementById("themeName").value = themeName;
                    document.getElementById("backgroundColor").value = themeSettings.backgroundColor;
                    document.getElementById("headingColor").value = themeSettings.headingColor;
                    document.getElementById("headingAlignment").value = themeSettings.headingAlignment;
                    document.getElementById("paragraphColor").value = themeSettings.paragraphColor;
                    document.getElementById("fontSize").value = themeSettings.fontSize;
                }
            }
        }

        // Fungsi untuk menyimpan tema yang baru ditambahkan atau diubah
        function saveSettings() {
            // Mendapatkan nilai input dari pengguna
            var themeName = document.getElementById("themeName").value;
            var backgroundColor = document.getElementById("backgroundColor").value;
            var headingColor = document.getElementById("headingColor").value;
            var headingAlignment = document.getElementById("headingAlignment").value;
            var paragraphColor = document.getElementById("paragraphColor").value;
            var fontSize = document.getElementById("fontSize").value;

            // Menyimpan pengaturan tema dalam objek
            var themeSettings = {
                backgroundColor: backgroundColor,
                headingColor: headingColor,
                headingAlignment: headingAlignment,
                paragraphColor: paragraphColor,
                fontSize: fontSize
            };

            // Simpan pengaturan tema ke dalam cookie dengan format yang konsisten
            document.cookie = "themeSettings_" + themeName + "=" + JSON.stringify(themeSettings);

            // Redirect kembali ke halaman home.html
            window.location.href = "home.php";
        }

        // Fungsi untuk mendapatkan nilai cookie berdasarkan namanya
        function getCookie(cookieName) {
            var name = cookieName + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var cookieArray = decodedCookie.split(';');
            for(var i = 0; i <cookieArray.length; i++) {
                var cookie = cookieArray[i];
                while (cookie.charAt(0) == ' ') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(name) == 0) {
                    return cookie.substring(name.length, cookie.length);
                }
            }
            return "";
        }

        // Jalankan fungsi fillFormWithThemeSettings saat halaman dimuat jika digunakan untuk mengedit tema
        window.onload = function () {
            fillFormWithThemeSettings();
        };
    </script>
</body>
</html>