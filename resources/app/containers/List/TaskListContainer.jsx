import React from "react";
import {connect} from "react-redux";
import {bindActionCreators} from "redux";
import tasks from "../../actions/tasks"

@connect(store => {
    return {
        tasks: store.tasks
    }
}, dispatch => {
    return {
        tasksAction: bindActionCreators(tasks, dispatch)
    }
})
class TaskListContainer extends React.Component {

    componentWillMount() {
        this.props.tasksAction.get()
    }

    render() {
        if (this.props.fetching)
            return <div>Loading...</div>
        if (!this.props.tasks.completed)
            return <div>Ошибка</div>

        const items = this.props.tasks.data;

        console.log(this.props.tasks)
        return <div className="panel">
            <table className="table">
                <tbody>
                {items.map((item) => {
                    return <tr key={item.id}>
                        <td>{item.name}</td>
                        <td>
                            <a href="javascript:void(0)" onClick={this.removeItem.bind(this, item.id)}>
                                <i style={{color: "red"}} className="fa fa-close"/>
                            </a>
                        </td>
                    </tr>
                })}
                </tbody>
            </table>
        </div>

    }

    removeItem(id) {
        this.props.tasksAction.delete(id)
        this.props.tasksAction.get()
    }
}
TaskListContainer.propTypes = {}
export default TaskListContainer
