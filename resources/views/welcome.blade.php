<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Parking Lot</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

<div id="app">
    <header>
        <h1>De Stelplaats</h1>
        <input type="text" id="json-input" placeholder="Enter JSON here">
        <button id="submit-json">GO</button>
    </header>

    <main>
        <div id="parking-lot">
            <br />
            <p>LARGE</p>
            <div class="bus large"></div>
            <div class="bus large"></div>
            <div class="bus large"></div>
            <br/>
            <p>MEDIUM</p>
            <br />

            <div class="bus medium"></div>
            <div class="bus medium"></div>
            <div class="bus medium"></div>
            <br/>
            <p>SMALL</p>
            <br />

            <div class="bus small"></div>
            <div class="bus small"></div>
            <div class="bus small"></div>
            <br />
        </div>
        <pre id="TODOBUSSES">BUSSES</p>
    </main>

    <footer>
        <button id="exit">EXIT</button>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/app.js"></script>

</body>
</html>
