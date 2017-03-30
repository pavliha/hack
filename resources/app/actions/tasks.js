import axios from "axios"
import types from "./types"
export default {

    get(){
        return {
            type: types.GET_TASKS,
            payload: axios.get("/api/tasks")
        }
    },

    add(task) {
        return {
            type: types.ADD_TASK,
            payload: axios.put("/api/tasks/"+id,task)
        }
    },

    delete(id) {
        return {
            type: types.DELETE_TASK,
            payload:  axios.delete("/api/tasks/"+id,)
        }
    },

}