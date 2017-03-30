import React from "react";
import Boot from "./Boot"
import TaskList from "./containers/List/TaskListContainer"

require("styles/main.styl")


Boot.renderReactFor(".js-TaskList", <TaskList/>)


