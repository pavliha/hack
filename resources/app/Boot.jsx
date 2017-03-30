import React from "react";
import {Provider} from "react-redux"
import store from "./store";
import ReactDOM from "react-dom";

export default class Boot {
    static renderReactFor(query, Layout) {
        let dom = document.querySelector(query);
        if(!dom) return null
        let props = dom.dataset;
        let newProps = {}
        for(let prop in props) {
            try {
                newProps[prop] = JSON.parse(props[prop]);
            } catch(e){
                newProps[prop] = props[prop];
            }
        }
        newProps.children = dom.innerHTML

        let layout = React.cloneElement(Layout, {...newProps})

        ReactDOM.render(
            <Provider store={store}>
                {layout}
            </Provider>, dom);
    }
}