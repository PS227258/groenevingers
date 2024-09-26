function fetchAllProducts(currentPage = 1, maxItems = null) {
    fetch("https://kuin.summaict.nl/api/product", {
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

            display.forEach((id) => {
                name.push(id.name)
            })
            display.forEach((id) => {
                description.push(id.description)
            })
            display.forEach((id) => {
                price.push(id.price)
            })
            display.forEach((id) => {
                image.push(id.image)
            })

            let table_body = document.getElementById("productTable")

            if (maxItems != null) {
                let limitCount = maxItems

                for (i = 1; i <= limitCount; i++) {
                    var row =
                        `
                    <div class="product-wrapper">
                        <img src="` +
                        image[i] +
                        `">
                        <div class="product-information">
                            <span class="product-name">` +
                        name[i] +
                        `</span>
                            <span class="product-price">€ ` +
                        price[i] +
                        `</span>
                        </div>
                    </div>`
                    table_body.innerHTML += row
                }
                return
            } else {
                let limitCount = Number(currentPage) * 50

                for (i = Number(limitCount) - 50; i <= limitCount; i++) {
                    var row =
                        `
                    <div class="product-wrapper">
                    <img src="` +
                        image[i] +
                        `">
                    <div class="product-information">
                    <span class="product-name">` +
                        name[i] +
                        `</span>
                    <span class="product-price">€ ` +
                        price[i] +
                        `</span>
                    </div>
                    </div>`
                    table_body.innerHTML += row
                }
            }
        })
}
