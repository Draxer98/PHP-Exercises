<?php

function jqueryScripts()
{ ?>
    <script>
        $(document).ready(function() {
            $("form").on("submit", function(e) {
                let isValid = true;

                $(".required-field").each(function() {
                    const value = $(this).val().trim();
                    const type = $(this).data("type");
                    const errorSpan = $(this).next(".error-msg");
                    errorSpan.hide();

                    if (value === "") {
                        errorSpan.text("Required field").show();
                        isValid = false;
                        return;
                    }

                    switch (type) {
                        case "username":
                            if (!/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/.test(value)) {
                                errorSpan.text("Only letters, no numbers or symbols").show();
                                isValid = false;
                            }
                            break;
                        case "email":
                            if (!/^\S+@\S+\.\S+$/.test(value)) {
                                errorSpan.text("Invalid email").show();
                                isValid = false;
                            }
                            break;
                        case "fiscal":
                            if (!/^[A-Za-z0-9]{16}$/.test(value)) {
                                errorSpan.text("The tax code must be 16 alphanumeric characters").show();
                                isValid = false;
                            }
                            break;
                        case "age":
                            const ageNum = parseInt(value);
                            if (isNaN(ageNum) || ageNum < 1 || ageNum > 99) {
                                errorSpan.text("Invalid age (1-99)").show();
                                isValid = false;
                            }
                            break;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });

            $(".required-field").on("input", function() {
                $(this).next(".error-msg").hide();
            });
        });
    </script>
<?php } ?>