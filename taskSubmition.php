<?php include "components/head.php" ?>

<body>
    <?php include "components/header.php" ?>
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
            <textarea id="code" class="d-none">
                #include <iostream>
                #include <vector>
                #include <string>
                
                int testFunc(std::vector<int> vec, int x);
                
                
                int main()
                {
                    if (testFunc({ 1,3,5 }, 2) != 15) {
                        std::cout << "Input: " << "{ 1,3,5 }, 2" << std::endl;
                        std::cout << "Your answer: " << testFunc({ 1,3,5 }, 2) << std::endl;
                        std::cout << "Expected answer: " << 15 << std::endl;
                        return 0;
                    }
                
                    if (testFunc({ 1,1,1 }, 2) != 9) {
                        std::cout << "Input: " << "{ 1,1,1 }, 2" << std::endl;
                        std::cout << "Your answer: " << testFunc({ 1,1,1 }, 2) << std::endl;
                        std::cout << "Expected answer: " << 9 << std::endl;
                        return 0;
                    }
                
                    if (testFunc({ 2,2,2 }, 5) != 21) {
                        std::cout << "Input: " << "{ 2,2,2 }, 5" << std::endl;
                        std::cout << "Your answer: " << testFunc({ 2,2,2 }, 5) << std::endl;
                        std::cout << "Expected answer: " << 21 << std::endl;
                        return 0;
                    }
                
                
                
                    std::cout << "All tests cleared!" << std::endl;
                    return 0;
                }
                
                int testFunc(std::vector<int> vec, int x)
                {
                    int ans = 0;
                    for (size_t i = 0; i < vec.size(); i++)
                    {
                        ans += vec[i] + x;
                    }
                
                    return ans;
                }
            </textarea>
        </div>
    </main>
    <?php include "components/footer.php" ?>
    <script>
        var cppFile = `<?php echo  $_SESSION['cppFile']; ?>`
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
                "code": $("#code").val(),
                "language": "cpp",
                "input": ""
            }),
        };

        $.ajax(settings).done(function (response) {
            // Replace newline characters with <br> tags
            var formattedOutput = response["output"].replace(/\n/g, '<br>');

            console.log(formattedOutput);

            // Set the formatted output in <p> tag
            $("#codeoutput").html(formattedOutput);
        });
    </script>
</body>