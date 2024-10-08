function Foldable(t, e) {
    ;(this.position = e),
        (this.element = document.querySelector(t)),
        this.element.classList.add("tt-foldable"),
        (this.foldButton = this._createFoldButton()),
        (this.isFolded = !1),
        (this.overflowTimeout = void 0),
        this._addFoldButton(),
        this._bindEvents()
}
;(Foldable.prototype._createFoldButton = function () {
    var t = document.createElement("button")
    return t.setAttribute("class", "tt-foldable__button -" + this.position), t
}),
    (Foldable.prototype._addFoldButton = function () {
        this.element.appendChild(this.foldButton)
    }),
    (Foldable.prototype._bindEvents = function () {
        this.foldButton.addEventListener("click", this._toggleFold.bind(this))
    }),
    (Foldable.prototype._toggleFold = function () {
        this.element.classList.toggle("-folded"),
            this.isFolded || this.element.classList.add("-open"),
            window.clearTimeout(this.overflowTimeout),
            this.isFolded &&
                (this.overflowTimeout = window.setTimeout(
                    function () {
                        this.element.classList.remove("-open")
                    }.bind(this),
                    200
                )),
            (this.isFolded = !this.isFolded)
    }),
    (window.Foldable = window.Foldable || Foldable)
