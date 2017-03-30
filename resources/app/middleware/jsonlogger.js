const jsonLogger = store => next => action => {
    if(window.log){
        console.log(JSON.stringify(store.getState()))
    }

    return next(action)
}
export default jsonLogger;