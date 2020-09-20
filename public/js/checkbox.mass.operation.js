$(document).ready(function () {
    $('#options').click(function () {
        if (this.checked) {
            $('.checkBox').each(function () {
                this.checked = true;
            })
        } else {
            $('.checkBox').each(function () {
                this.checked = false;
            })
        }
    })
})
