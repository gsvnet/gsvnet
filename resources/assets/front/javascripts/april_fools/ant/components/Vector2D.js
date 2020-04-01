class Vector2D {

    constructor(x = 0, y = 0) {
        this.x = x
        this.y = y
    }

    _getXY(XorVector, YorNothing) {
        return XorVector instanceof Vector2D ? [XorVector.x, XorVector.y] : [XorVector, YorNothing]
    }

    add(XorVector, YorNothing) {
        const [x, y] = this._getXY(XorVector, YorNothing)
        return new Vector2D(this.x + x, this.y + y)
    }

    subtract(XorVector, YorNothing) {
        const [x, y] = this._getXY(XorVector, YorNothing)
        return new Vector2D(this.x - x, this.y - y)
    }

    divide(n) {
        return new Vector2D(this.x / n, this.y / n)
    }

    multiply(n) {
        return new Vector2D(this.x * n, this.y * n)
    }

    magnitude(n) {
        if (n) {
            return this.normalize().multiply(n);
        } else {
            const [x, y] = [this.x, this.y]
            return Math.sqrt(x * x + y * y)
        }
    }

    normalize() {
        return this.divide(this.magnitude())
    }

    dot(XorVector, YorNothing) {
        const [x, y] = this._getXY(XorVector, YorNothing)
        return this.x * x + this.y * y
    }

    distance(vector) {
        return vector.subtract(this).magnitude()
    }

    headingRads() {
        return Math.atan2(this.x, this.y)
    }

    headingDegs() {
        return this.headingRads() * 180 / Math.PI
    }

    rotateRads(rads) {
        const newHeading = this.headingRads() + rads
        const magnitude = this.magnitude()
        return new Vector2D(Math.cos(newHeading) * magnitude, Math.sin(newHeading) * magnitude)
    }

    rotateDegs(degs) {
        return this.rotateRads(degs * Math.PI / 180)
    }

    angleBetweenRads(XorVector, YorNothing) {
        const [x, y] = this._getXY(XorVector, YorNothing)
        const to = new Vector2D(x, y)
        return Math.acos(this.dot(to) / (this.magnitude() * to.magnitude()))
    }

    angleBetweenDegs(XorVector, YorNothing) {
        return this.angleBetweenRads(XorVector, YorNothing) * 180 / Math.PI
    }

    /*lerp(x, y, amount) {
        if (x instanceof Vector2D) return this.lerp(x.x, x.y, y)
        amount = Math.min(amount, 1)
        return new Vector2D(this.x + ())
    }*/
    equals(XorVector, YorNothing) {
        const [x, y] = this._getXY(XorVector, YorNothing)
        return this.x === x && this.y === y
    }
}

export default Vector2D