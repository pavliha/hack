import types from "../../actions/types"
import initialState from "../initialState";

const initial = {
    ...initialState,
    data:[],
    ids:[]
}
export default (state = initial, action) => {

    switch (action.type) {
        case types.ADD_TASK:

            return {
                ...state,
                ids: action.payload,
            };

        case types.DELETE_TASK+"_PENDING":
            return {
                ...state,
                fetching: true,
            }

        case types.DELETE_TASK+"_FULFILLED":
            return {
                ...state,
                data:action.payload.data,
                completed:true,
            }

        case types.DELETE_TASK+"_REJECTED":
            return {
                ...state,
                error:true
            }

        case types.GET_TASKS+"_PENDING":
            return {
                ...state,
                fetching: true,
            }

        case types.GET_TASKS+"_FULFILLED":
            return {
                ...state,
                data:action.payload.data,
                completed:true,
            }

        case types.GET_TASKS+"_REJECTED":
            return {
                ...state,
                error:true
            }
        default:
            return state
    }
};
