import Scene from './components/Scene'
import Ant from './components/Ant'
import Util from './components/Util'

function startAnt() {
    const scene = new Scene()
    const ant = new Ant(['p', 'h1', 'h2', 'h3', 'time', '.form-group', '.avatar', '.author'])
    window.ant = ant
    console.log(ant)
    scene.add(ant)
    scene.loop()
}

export default startAnt