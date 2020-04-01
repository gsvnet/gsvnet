class Angle {

    constructor(deg = 0) {
        this.deg = this.constructor.normalize(deg)
        return this
    }

    static normalize(deg) {
        deg = deg % 360
        if (deg === 360) deg = 0
        if (deg < 0) deg = 360 + deg
        return deg
    }

    add(AngleOrDeg) {
        const deg = AngleOrDeg instanceof Angle ? AngleOrDeg.deg : AngleOrDeg

        return new Angle(this.deg + deg)
    }

    subtract(AngleOrDeg) {
        const deg = AngleOrDeg instanceof Angle ? AngleOrDeg.deg : AngleOrDeg

        return this.add(-deg)
    }

    distance(AngleOrDeg) {
        const deg = AngleOrDeg instanceof Angle ? AngleOrDeg.deg : AngleOrDeg

        const diff = Math.abs(this.deg - this.constructor.normalize(deg))
        return diff <= 180 ? diff : 360 - diff
    }
}

export default Angle