$(function () {
    $(".search-form_button").on("click", function () {
        $(".tbody").empty();
        let keyword = $(".search-form_input").val();
        let key = $(".search-form_select").val();
        let price_upper = $(".search-form_price_upper").val();
        let price_lower = $(".search-form_price_lower").val();
        let stock_upper = $(".search-form_stock_upper").val();
        let stock_lower = $(".search-form_stock_lower").val();
        $.ajax({
            type: "get",
            url:
                "/ms/public/search?" +
                keyword +
                "=&" +
                key +
                "=&" +
                price_upper +
                "=&" +
                price_lower +
                "=&" +
                stock_upper +
                "=&" +
                stock_lower,
            data: {
                keyword,
                key,
                price_upper,
                price_lower,
                stock_upper,
                stock_lower,
            },
            dataType: "json",
        })
            .done(function (data) {
                console.log(data);
                let html = "";
                $.each(data, function (index, value) {
                    let id = value.id;
                    let img_path = value.img_path;
                    let product_name = value.product_name;
                    let price = value.price;
                    let stock = value.stock;
                    let company_name = value.company_name;
                    html += `
                                        <tr class="tbody_list">
                                            <td class="tbody_list_item">${id}</td>
                                            <td class="tbody_list_item"><img src="${img_path}" alt="${img_path}"></td>
                                            <td class="tbody_list_item">${product_name}</td>
                                            <td class="tbody_list_item">${price}</td>
                                            <td class="tbody_list_item">${stock}</td>
                                            <td class="tbody_list_item">${company_name}</td>
                                            <td class="tbody_list_item">
                                                <form method="get" action="/ms/public/sale/${id}">
                                                    <button type="submit" >詳細</button>
                                                </form>
                                            </td>
                                            <td class="tbody_list_item">
                                                <input data-user_id="${id}" class="list_btn" type="submit" value="削除">
                                            </td>
                                        </tr>
                                        `;
                });
                $(".tbody").append($(html));
            })
            .fail(function () {
                console.log("error");
            });
    });
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="token"]').attr("content"),
    },
});

$(document).on("click", ".list_btn", function () {
    var deleteConfirm = confirm("この行を削除してもよろしいですか？");

    if (deleteConfirm) {
        var clickEle = $(this);
        var userID = clickEle.attr("data-user_id");

        $.ajax({
            url: "/ms/public/sale/" + userID,
            type: "POST",
            data: { id: userID },
            dataType: "json",
        })
            .done(function (data) {
                clickEle.closest(".tbody_list").remove();
                console.log(data);
            })
            .fail(function () {
                alert("エラー");
                console.log("aa");
            });
    } else {
        return false;
    }
});

$(document).ready(function () {
    $("th.sortable_id").click(function () {
        var idx = $(this).index();
        var sortDirection = $(this).hasClass("asc") ? "desc" : "asc";
        $("th.sortable_id").removeClass("asc desc");
        $(this).addClass(sortDirection);
        var rows = $("tr.tbody_list")
            .toArray()
            .sort(compareCells(idx, sortDirection));
        $(".tbody").empty().append(rows);
    });

    function compareCells(idx, sortDirection) {
        return function (a, b) {
            var aVal = parseFloat($(a).find("td").eq(idx).text());
            var bVal = parseFloat($(b).find("td").eq(idx).text());
            if (sortDirection === "asc") {
                return aVal - bVal;
            } else {
                return bVal - aVal;
            }
        };
    }
});

$(document).ready(function () {
    $("th.sortable_img").click(function () {
        var idx = $(this).index();
        var sortDirection = $(this).hasClass("asc") ? "desc" : "asc";
        $("th.sortable_img").removeClass("asc desc");
        $(this).addClass(sortDirection);
        var rows = $("tr.tbody_list")
            .toArray()
            .sort(compareCells(idx, sortDirection));
        $(".tbody").empty().append(rows);
    });

    function compareCells(idx, sortDirection) {
        return function (a, b) {
            var aVal = $(a).find("td").eq(idx).text();
            var bVal = $(b).find("td").eq(idx).text();
            if (sortDirection === "asc") {
                return aVal.localeCompare(bVal);
            } else {
                return bVal.localeCompare(aVal);
            }
        };
    }
});

$(document).ready(function () {
    $("th.sortable_product_name").click(function () {
        var idx = $(this).index();
        var sortDirection = $(this).hasClass("asc") ? "desc" : "asc";
        $("th.sortable_product_name").removeClass("asc desc");
        $(this).addClass(sortDirection);
        var rows = $("tr.tbody_list")
            .toArray()
            .sort(compareCells(idx, sortDirection));
        $(".tbody").empty().append(rows);
    });

    function compareCells(idx, sortDirection) {
        return function (a, b) {
            var aVal = $(a).find("td").eq(idx).text();
            var bVal = $(b).find("td").eq(idx).text();
            if (sortDirection === "asc") {
                return aVal.localeCompare(bVal);
            } else {
                return bVal.localeCompare(aVal);
            }
        };
    }
});

$(document).ready(function () {
    $("th.sortable_price").click(function () {
        var idx = $(this).index();
        var sortDirection = $(this).hasClass("asc") ? "desc" : "asc";
        $("th.sortable_price").removeClass("asc desc");
        $(this).addClass(sortDirection);
        var rows = $("tr.tbody_list")
            .toArray()
            .sort(compareCells(idx, sortDirection));
        $(".tbody").empty().append(rows);
    });

    function compareCells(idx, sortDirection) {
        return function (a, b) {
            var aVal = parseFloat($(a).find("td").eq(idx).text());
            var bVal = parseFloat($(b).find("td").eq(idx).text());
            if (sortDirection === "asc") {
                return aVal - bVal;
            } else {
                return bVal - aVal;
            }
        };
    }
});

$(document).ready(function () {
    $("th.sortable_stock").click(function () {
        var idx = $(this).index();
        var sortDirection = $(this).hasClass("asc") ? "desc" : "asc";
        $("th.sortable_stock").removeClass("asc desc");
        $(this).addClass(sortDirection);
        var rows = $("tr.tbody_list")
            .toArray()
            .sort(compareCells(idx, sortDirection));
        $(".tbody").empty().append(rows);
    });

    function compareCells(idx, sortDirection) {
        return function (a, b) {
            var aVal = parseFloat($(a).find("td").eq(idx).text());
            var bVal = parseFloat($(b).find("td").eq(idx).text());
            if (sortDirection === "asc") {
                return aVal - bVal;
            } else {
                return bVal - aVal;
            }
        };
    }
});

$(document).ready(function () {
    $("th.sortable_company_name").click(function () {
        var idx = $(this).index();
        var sortDirection = $(this).hasClass("asc") ? "desc" : "asc";
        $("th.sortable_company_name").removeClass("asc desc");
        $(this).addClass(sortDirection);
        var rows = $("tr.tbody_list")
            .toArray()
            .sort(compareCells(idx, sortDirection));
        $(".tbody").empty().append(rows);
    });

    function compareCells(idx, sortDirection) {
        return function (a, b) {
            var aVal = $(a).find("td").eq(idx).text();
            var bVal = $(b).find("td").eq(idx).text();
            if (sortDirection === "asc") {
                return aVal.localeCompare(bVal);
            } else {
                return bVal.localeCompare(aVal);
            }
        };
    }
});
