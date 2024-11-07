$(document).ready(function () {
    // Populate year dropdown on country change
    $("#country")
        .change(function () {
            let country = $(this).val();
            $.ajax({
                url: "/api/years",
                data: { country: country },
                success: function (years) {
                    let yearOptions = "";
                    years.forEach(function (year) {
                        yearOptions += `<option value="${year}">${year}</option>`;
                    });
                    $("#year").html(yearOptions);
                },
            });
        })
        .trigger("change");

    // Calculate financial year and fetch holidays
    $("#calculate").click(function () {
        let country = $("#country").val();
        let year = $("#year").val();

        $.ajax({
            url: "/api/financial-year",
            data: { country: country, year: year },
            success: function (financialYear) {
                $("#financial-year").text(
                    `Financial Year Start: ${financialYear.start}, End: ${financialYear.end}`
                );

                // Fetch holidays within the financial year
                $.ajax({
                    url: "/api/holidays",
                    data: {
                        country: country,
                        start: financialYear.start,
                        end: financialYear.end,
                    },
                    success: function (holidays) {
                        let holidaysList = "";
                        holidays.forEach(function (holiday) {
                            holidaysList += `<li class="list-group-item">${holiday.name} - ${holiday.date}</li>`;
                        });
                        $("#holidays-list").html(holidaysList);
                    },
                });
            },
        });
    });
});
