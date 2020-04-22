class Scene {

    constructor() {
        this.lastFrameTime = (new Date().getTime())
        this.currentFrameTime = 0
        this.elements = []
    }

    add(sceneElement) {
        this.elements.push(sceneElement)
    }

    loop() {
        requestAnimationFrame(this.loop.bind(this))
        this.currentFrameTime = new Date().getTime()
        const deltaTime = (this.currentFrameTime - this.lastFrameTime) / 1000

        this.elements.forEach(el => el.update(deltaTime, this.currentFrameTime))

        this.lastFrameTime = this.currentFrameTime
    }
}

export default Scene