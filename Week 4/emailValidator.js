window.onload=initialise;
function initialise()
{
    registerValidation(
        document.getElementById('url'),
        document.getElementById('urlMsg')
    );
    registerValidation(
        document.getElementById('email'),
        document.getElementById('emailMsg')
    );
    registerValidation(
        document.getElementById('number'),
        document.getElementById('numMsg')
    );
}
function registerValidation(element, span)
{
    element.onblur = function() {
        span.textContent = element.validationMessage;
    }
}