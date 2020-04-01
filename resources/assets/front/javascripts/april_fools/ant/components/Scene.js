class Scene {

    constructor() {
        this.lastFrameTime = (new Date().getTime())
        this.currentFrameTime = 0
        this.elements = []
        this.pause = false
    }

    add(sceneElement) {
        this.elements.push(sceneElement)
    }

    togglePause() {
        this.pause = !this.pause
        if(!this.pause)this.loop()
        return this.pause
    }

    loop() {
        if(!this.pause)requestAnimationFrame(this.loop.bind(this))
        this.currentFrameTime = new Date().getTime()
        const deltaTime = (this.currentFrameTime - this.lastFrameTime) / 1000

        this.elements.forEach(el => el.update(deltaTime, this.currentFrameTime))

        this.lastFrameTime = this.currentFrameTime
    }
}

export default Scene