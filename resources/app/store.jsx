import { applyMiddleware, createStore } from "redux"
import throttle from "lodash/throttle"
import logger from "redux-logger"
import thunk from "redux-thunk"
import promise from "redux-promise-middleware"
import jsonLogger from './middleware/jsonlogger'
import reducer from "./reducers"
import {saveState,loadState} from "./modules/localStorage"
const middleware = applyMiddleware(promise(), thunk, logger(),jsonLogger)

let store = createStore(reducer,loadState(),middleware)
store.subscribe(throttle(()=>{
    saveState(store.getState())
},1000))
export default store