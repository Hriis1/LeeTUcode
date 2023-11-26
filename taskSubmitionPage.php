<?php include_once "components/head.php" ?>

<body>
    <?php include_once "components/header.php" ?>
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="submition-result col-12 bg-light border border-secondary rounded ps-3 pt-2">
                    <h3>Submition result:</h3>
                    <p id="codeoutput" style="height: 100px;"></p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <button type="button" class="btn btn-primary btn-lg" onclick="goBack()">Back</button>
                </div>
            </div>
        </div>
    </main>
    <?php include_once "components/footer.php" ?>
    <script>
        var cppFile = `<?php echo $_SESSION['cppFile']; ?>`
        console.log(cppFile);
        var settings = {
            "url": "https://api.codex.jaagrav.in",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
                "Authorization": "Basic dXZLREoyRXVmUkpWRlN4T3FweTo="
            },
            "data": JSON.stringify({
                "code": cppFile,
                "language": "cpp",
                "input": ""
            }),
        };

        $.ajax(settings).done(function (response) {
            if (response["output"] != "") {
                // Replace newline characters with <br> tags
                var formattedOutput = response["output"].replace(/\n/g, '<br>');

                console.log(formattedOutput);

                // Set the formatted output in <p> tag
                $("#codeoutput").html(formattedOutput);
            }
            else
            {
                console.log(response);
                $("#codeoutput").html("Program did not compile correctly! <br>" + response["error"]);
            }
        });
    </script>
</body>