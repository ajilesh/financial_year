<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Financial Year Finder</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h4>Select Country and Year</h4>
    <div class="form-group">
        <label for="country">Country:</label>
        <select id="country" class="form-control">
            <option value="">Select Country</option>
            <option value="UK">United Kingdom</option>
            <option value="Ireland">Ireland</option>
        </select>
    </div>
    <div class="form-group">
        <label for="year">Year:</label>
        <select id="year" class="form-control">
            <option value="">Select Year</option>
        </select>
    </div>
    <button id="submit" class="btn btn-primary">Get Financial Year</button>
    
    <h5 class="mt-4">Financial Year Details</h5>
    <p id="financial-year"></p>
    <h6>Holidays (Excluding Weekends)</h6>
    <ul id="holidays"></ul>
</div>

<script>
    $(document).ready(function() {
        $('#country').change(function() {
            const country = $(this).val();
            if (country) {
                $.getJSON(`/years/${country}`, function(data) {
                    $('#year').empty().append('<option value="">Select Year</option>');
                    $.each(data, function(index, value) {
                        $('#year').append(`<option value="${value}">${value}</option>`);
                    });
                });
            } else {
                $('#year').empty().append('<option value="">Select Year</option>');
            }
        });

        $('#submit').click(function() {
            const country = $('#country').val();
            const year = $('#year').val();
            if (country && year) {
                $.getJSON(`/holidays?country=${country}&year=${year}`, function(data) {
                    $('#financial-year').text(`Financial Year Start : ${data.start} | Financial Year End : ${data.end}`);
                    $('#holidays').empty();
                    $.each(data.holidays, function(index, holiday) {
                        $('#holidays').append(`<li>${holiday.name} - ${holiday.date}</li>`);
                    });
                });
            }
        });
    });
</script>
</body>
</html>
