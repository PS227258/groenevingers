function fetchProduct(id) {
    fetch(`https://kuin.summaict.nl/api/product/` + id, {
        headers: {
            Authorization: "Bearer 50|Oy8mM3g2A8jSTpiHoxrRXXdspGlvQHbbQ45qM272",
        },
    })
        .then((resp) => resp.json())
        .then((respData) => {
            let display = respData
            let name = []
            let description = []
            let price = []
            let image = []

            name.push(display.name)
            description.push(display.description)
            price.push(display.price)
            image.push(display.image)

            let table_body = document.getElementById("productTable")
            var row =
                `
        <div class="product-wrapper">
        <img src="` +
                image +
                `">
        <div class="product-information">
        <span class="product-name">` +
                name +
                `</span>
        <span class="product-price">€ ` +
                price +
                `</span>
        </div>
        </div>`
            table_body.innerHTML += row
        })
}
