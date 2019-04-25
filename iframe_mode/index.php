<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connect - iFrame</title>
</head>
<body>
    <iframe name="myFrame" id="myFrame" src="http://localhost/connect/iframe_mode/iframe-form.php" width="460px" height="900px" style="border: none;">
        Your browser does not support inline frames.
    </iframe>
    <script>
        window.onload = function(e) {
            window.addEventListener("message", receiveMessage, false);
            //checkoutForm.submit();
        }
        function receiveMessage(event) {
            if (event.origin != "https://test.ipg-online.com")
                return;
            var elementArr = event.data.elementArr;
            forwardForm(event.data, elementArr);
        }
        function forwardForm(responseObj, elementArr) {
            var newForm = document.createElement("form");
            newForm.setAttribute('method',"post");
            newForm.setAttribute('action',responseObj.redirectURL);
            newForm.setAttribute('id',"newForm");
            newForm.setAttribute('name',"newForm");
            document.body.appendChild(newForm);
            for(var i = 0 ; i < elementArr.length; i++) {
                var element = elementArr[i];
                var input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("name", element.name);
                input.setAttribute("value", element.value);
                document.newForm.appendChild(input);
            }
            document.newForm.submit();
        }
    </script>
</body>
</html>