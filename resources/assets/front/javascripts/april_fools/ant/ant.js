import Scene from './components/Scene'
import Ant from './components/Ant'
import Util from './components/Util'

function startAnt() {
    const scene = new Scene()
    const ant = new Ant([
        'p', 'h1', 'h2', 'h3', '.form-group', '.avatar', '.like-box', '.media-counter',
        '.author', '.tags', '.list-title', '.list-description', '.media-details > a > span',
        '.media-body .inline-list', '.pagination > li', '.photo-tile', '.profile-image'
    ])
    window.ant = ant
    console.log(ant)
    scene.add(ant)
    scene.loop()
    
    window.pauze = function() {
        scene.togglePause()
    }
}

export default startAnt