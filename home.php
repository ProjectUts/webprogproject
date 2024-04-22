<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
    <label for="themes">Select Theme:</label>
    <select id="themes">
        <option value="none">None</option>
        <!-- Tema-tema akan ditambahkan secara dinamis melalui JavaScript -->
    </select>
    <button onclick="chooseTheme()">Choose Theme</button>
    <button onclick="editTheme()">Edit Theme</button>

    <!-- Hyperlink untuk menuju halaman Add New Theme -->
    <a href="theme.php">Add New Theme</a>

    <h1 id="heading">Heading 1</h1>
    <p id="paragraph1">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
    <p id="paragraph2">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?" </p>

    <script>
        // Ambil semua cookie
        function getCookies() {
            var cookies = document.cookie.split(';');
            var cookieList = {};
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].split('=');
                cookieList[cookie[0].trim()] = cookie[1];
            }
            return cookieList;
        }

        // Fungsi untuk mengatur tema yang dipilih
        function chooseTheme() {
            var themesSelect = document.getElementById("themes");
            var selectedTheme = themesSelect.options[themesSelect.selectedIndex].text;
            var cookies = getCookies();

            // Cari tema yang sesuai dengan yang dipilih dalam cookie
            var selectedThemeSettings = JSON.parse(cookies["themeSettings_" + selectedTheme]);
            if (selectedThemeSettings) {
                document.body.style.backgroundColor = selectedThemeSettings.backgroundColor;
                document.getElementById("heading").style.color = selectedThemeSettings.headingColor;
                document.getElementById("heading").style.textAlign = selectedThemeSettings.headingAlignment;
                document.getElementById("paragraph1").style.color = selectedThemeSettings.paragraphColor;
                document.getElementById("paragraph2").style.color = selectedThemeSettings.paragraphColor;
                document.getElementById("paragraph1").style.fontSize = selectedThemeSettings.fontSize + "px";
                document.getElementById("paragraph2").style.fontSize = selectedThemeSettings.fontSize + "px";
            }
        }

        // Fungsi untuk mengisi ComboBox dengan tema-tema yang tersedia
        function populateThemes() {
            var themesSelect = document.getElementById("themes");
            themesSelect.innerHTML = ""; // Kosongkan isi ComboBox sebelum mengisi kembali
            var cookies = getCookies();

            // Tambahkan opsi None ke ComboBox
            var noneOption = document.createElement("option");
            noneOption.value = "none";
            noneOption.text = "None";
            themesSelect.add(noneOption);

            // Tambahkan setiap tema ke dalam ComboBox
            for (var cookie in cookies) {
                if (cookie.startsWith("themeSettings_")) {
                    var themeName = cookie.substring("themeSettings_".length);
                    var option = document.createElement("option");
                    option.value = themeName;
                    option.text = themeName;
                    themesSelect.add(option);
                }
            }
        }

        // Fungsi untuk mengarahkan ke halaman Add New Theme untuk mengedit tema yang dipilih
        function editTheme() {
            var themesSelect = document.getElementById("themes");
            var selectedTheme = themesSelect.options[themesSelect.selectedIndex].text;
            // Redirect ke halaman theme.html dengan mengirimkan nama tema yang dipilih sebagai parameter
            window.location.href = "theme.php?theme=" + encodeURIComponent(selectedTheme);
        }

        // Jalankan fungsi populateThemes saat halaman dimuat
        window.onload = function () {
            populateThemes();
            chooseTheme(); // Terapkan tema yang dipilih saat halaman dimuat
        };
    </script>
</body>
</html>
