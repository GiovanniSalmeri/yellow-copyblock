// Copyblock extension, https://github.com/GiovanniSalmeri/yellow-copyblock

"use strict";
document.addEventListener("DOMContentLoaded", function() {
    var codeblocks = document.querySelectorAll("pre > code, div.mu > *, div.math > *");
    codeblocks.forEach(function(codeblock, i) {
        var button = document.createElement("button");
        button.classList.add("copyblock");
        button.classList.add("btn");
        button.setAttribute("aria-label", yellow.copyblock.copyblockButton);
        button.addEventListener("click", copy);
        codeblock.insertAdjacentElement("afterend", button);
    });

    function copy() {
        if (this.parentElement.nodeName=="PRE") {
            var describedBy = this.parentElement.getAttribute("aria-describedby");
            if (describedBy!==null) {
                var code = document.getElementById(describedBy.split(" ")[0]).textContent;
            } else {
                var code = this.previousElementSibling.textContent;
            }
        } else {
            var code = this.previousElementSibling.querySelector("annotation").textContent;
        }
        if (navigator.clipboard) {
            navigator.clipboard.writeText(code);
        } else {
            var textarea = document.createElement("textarea");
            textarea.value = code;
            textarea.display = "none";
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);
        }
    }
});
