$(document).ready(function() {
    //when plus button click
    $('.btn-plus').click(function() {
            $parentNode = $(this).parents("tr");
            // $price = $parentNode.find('#price').val();
            $price = Number($parentNode.find('#pizzaPrice').text().replace('Kyats', ''));
            $qty = $parentNode.find('#qty').val();
            $total = $price * $qty;
            $parentNode.find('#total').html($total + " Kyats")
                // console.log($total);
                // console.log($price);
                // console.log($qty);
            summaryCalculation();

        })
        //when minus button click
    $('.btn-minus').click(function() {
            $parentNode = $(this).parents("tr");
            // $price = $parentNode.find('#price').val();
            $price = Number($parentNode.find('#pizzaPrice').text().replace('Kyats', ''));
            $qty = $parentNode.find('#qty').val();
            $total = $price * $qty;
            $parentNode.find('#total').html($total + " Kyats")
                // console.log($total);
                // console.log($price);
                // console.log($qty);
            summaryCalculation();

        })
        //when cross button click


    function summaryCalculation() {
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index, row) {
            $totalPrice += Number($(row).find('#total').text().replace('Kyats', ''));
        })
        $('#subTotalPrice').html(`${$totalPrice} Kyats`)
        $('#finalPrice').html(`${$totalPrice+3000} Kyats`)
    }
})