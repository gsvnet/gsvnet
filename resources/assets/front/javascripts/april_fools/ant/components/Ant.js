import Angle from "./Angle"
import Vector2D from "./Vector2D"
import Util from "./Util"

const ROTATION_SPEED = 150
const MOVEMENT_SPEED = 120
const SCREEN_BORDER = 50 // Document border in pixels that the ant will not try to move in

class Ant {

    // @pickups array of css selectors of valid items to pickup and move
    constructor(pickups = []) {
        this.pickups = pickups
        this.currentPickup
        this.moveQueue = [{ move: 'moveRandom' }]
        this.documentDimensions = Util.getDocumentDimensions()

        const el = document.createElement('div')
        const center = document.createElement('div')
        const nametag = document.createElement('div')
        nametag.classList.add('ant_nametag')
        nametag.innerHTML = Util.getCookie('ant_name') || "Wilfred"
        el.classList.add('ant')
        center.classList.add('ant_center')
        el.appendChild(center)
        document.body.appendChild(el)
        document.body.appendChild(nametag)

        el.addEventListener("click", this.changeName.bind(this))

        this.el = el
        this.center = center
        this.nametag = nametag

        this.current = {
            position: this.getPosition(),
            rotation: new Angle(0)
        }
        this.target = {
            position: new Vector2D(),
            rotation: new Angle(0)
        }
        this.pauseUntil = 0
        //this.i = 0
    }

    update(deltaTime, currentTime) {
        //this.i++
        //if (this.i < 200) return
        if (this.pauseUntil > currentTime) return
        const curr = this.current
        const target = this.target
        let walking = true

        // Do rotation if necessary
        if (curr.rotation.deg != target.rotation.deg) {
            //const rotDiff = Math.abs(curr.rotation.deg - target.rotation.deg)
            const rotateDist = curr.rotation.distance(target.rotation)
            const rotateDir = curr.rotation.subtract(target.rotation).deg > 180 ? 1 : -1
            //console.log('ROT dist:', curr.rotation.deg, target.rotation.deg, rotateDist, curr.rotation.subtract(target.rotation), rotateDir)
            const rotation = Math.min(rotateDist, ROTATION_SPEED * deltaTime)
            curr.rotation = curr.rotation.add(rotateDir * rotation)

            //this.el.style.transform = `rotate(${curr.rotation.deg}deg)`
        } else if (!curr.position.equals(target.position)) {
            // Otherwise move if necessary
            const difference = target.position.subtract(curr.position)
            const movement = difference.magnitude(Math.min(curr.position.distance(target.position), MOVEMENT_SPEED * deltaTime))
            curr.position = curr.position.add(movement)
            //this.el.style.transform = `translate(${curr.position.x}px, ${curr.position.y}px)`
            //console.log(difference, movement)
        } else {
            // Otherwise decide on what to do next
            walking = false
            this.decideNextMove()
        }
        if (walking != this.el.classList.contains('walking')) {
            this.el.classList.toggle('walking')
        }

        this.setTransform(curr.position, curr.rotation)
    }

    decideNextMove() {
        // Moveset. Chances should add up to 1.
        const moves = {
            'pause': {
                debug: 'taking a break',
                chance: 0.45,
                do: function () {
                    this.pauseFor(Util.randomInteger(3, 5))
                }
            },
            'moveRandom': {
                debug: 'moving to a random location',
                chance: 0.15,
                do: function () {
                    const { width, height } = this.documentDimensions
                    const pos = [Util.randomInteger(0 + SCREEN_BORDER, width - SCREEN_BORDER), Util.randomInteger(0 + SCREEN_BORDER, height - SCREEN_BORDER)]
                    this.lookAt(...pos)
                    this.moveTo(...pos)
                    //console.log(this.target.position, this.target.rotation)
                }
            },
            'moveToElement': {
                debug: 'moving to a page element in order to pick it up',
                chance: 0.4,
                do: function () {
                    const selector = Util.arraySample(this.pickups)
                    const pickup = Util.arraySample(document.querySelectorAll(selector))
                    const { x, y } = Util.getElementXY(pickup)
                    const target = [x - (this.el.offsetHeight / 2.2), y]
                    console.log(pickup)

                    this.lookAt(...target)
                    this.moveTo(...target)
                    //this.pauseFor(1)
                    this.moveQueue.push({
                        move: 'lookAtElement',
                        data: pickup
                    })
                }
            },
            'lookAtElement': {
                debug: 'looking target element',
                chance: 0, // 0 chance because this should only happen after moving to an element first
                do: function (pickup) {
                    const { x, y } = Util.getElementXY(pickup)
                    const target = [x, y]
                    this.lookAt(...target)
                    //this.pauseFor(2)
                    this.moveQueue.push({
                        move: 'pickupElement',
                        data: pickup
                    })
                }
            },
            'pickupElement': {
                debug: 'picking up target element',
                chance: 0, // 0 chance because this should only happen after moving to an element first
                do: function (pickup) {

                    if (!pickup.basePos) {
                        const { x, y } = Util.getElementXY(pickup)
                        pickup.basePos = { x, y }
                    }
                    this.currentPickup = pickup

                    this.moveQueue.push({
                        move: 'moveRandom'
                    }, {
                        move: 'lookRight'
                    }, {
                        move: 'dropElement'
                    })
                }
            },
            'lookRight': {
                debug: 'looking right',
                chance: 0,
                do: function () {
                    const { x, y } = this.getPosition()
                    this.lookAt(x + 1, y)
                }
            },
            'dropElement': {
                debug: 'dropping current element',
                chance: 0,
                do: function () {
                    this.currentPickup = undefined
                }
            }
        }

        // If there is a move in queue, execute that, otherwise choose randomly from available moves
        let nextMove, moveData
        const moveQueue = this.moveQueue
        if (moveQueue.length) {
            const moveQueueItem = moveQueue.shift()
            nextMove = moves[moveQueueItem.move]
            moveData = moveQueueItem.data
            //console.log(moveQueue.shift())
        } else {
            const moveChoice = Math.random()
            let cumulativeChance = 0

            nextMove = Object.values(moves).find((move) => {
                cumulativeChance += move.chance
                return cumulativeChance > moveChoice
            })
        }

        console.log(`Ant next action: ${nextMove.debug}`)
        Reflect.apply(nextMove.do, this, [moveData])
    }

    setTransform(position, rotation) {
        const el = this.el
        const nametag = this.nametag
        el.style.transform = `translate(${position.x}px, ${position.y}px) rotate(${rotation.deg}deg)`
        nametag.style.transform = `translate(${position.x - (nametag.offsetWidth / 2)}px, ${position.y + (el.offsetHeight / 2)}px)`
        const pickup = this.currentPickup
        if (pickup) {
            const basePos = pickup.basePos
            pickup.style.transform = `translate(${position.x - basePos.x}px, ${position.y - basePos.y}px) rotate(${rotation.deg - 90}deg)`
            pickup.style.transformOrigin = '0 0'
        }
    }

    changeName() {
        console.log(this)
        const name = prompt("Naam:", this.nametag.innerText)
        this.nametag.innerText = name.substr(0, 16)
        Util.setCookie('ant_name', name, 30)
    }

    getPosition() {
        const { x, y } = Util.getElementXY(this.center)
        return new Vector2D(x, y)
    }

    moveTo(x, y) {
        //this.lookAt(x, y)
        this.target.position = new Vector2D(x, y)
    }

    lookAt(x, y) {
        const { x: elX, y: elY } = this.getPosition()
        this.target.rotation = new Angle(Math.atan2(y - elY, x - elX) * 180 / Math.PI + 90)
        //console.log(this.current.rotation, this.target.rotation)
    }

    pauseFor(seconds) {
        this.pauseUntil = new Date().getTime() + seconds * 1000
    }
}

export default Ant