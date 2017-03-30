export function loadState(){
    try{
        const serializedStorage = localStorage.getItem("state")
        if(serializedStorage === null){
            return undefined
        }
        return JSON.parse(serializedStorage);
    }catch(err){
        return undefined
    }
}

export function saveState(state) {
    try{
        const serializedState = JSON.stringify(state)
        localStorage.setItem("state",serializedState)
    }catch(e){
        throw new Error("failed to save state "+e)
    }
}