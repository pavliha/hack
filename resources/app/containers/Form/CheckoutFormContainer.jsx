import React from "react";
import {connect} from "react-redux";
import {bindActionCreators} from "redux";
import cart from "../../actions/cart"

@connect(store => {
    return {
        cart: store.cart
    }
}, dispatch => {
    return {
        tasksAction: bindActionCreators(cart, dispatch)
    }
})
class CheckoutFormContainer extends React.Component {

    componentWillMount() {
        this.props.tasksAction.get()
    }

    render() {
        if (this.props.fetching)
            return <div>Loading...</div>
        if (!this.props.cart.completed)
            return <div>Ошибка</div>

        const items = this.props.cart.data;

        return <div className="card">
            <table className="table">
                <tbody>
                {items.map((item) => {
                    return <tr key={item.id}>
                        <td><img src={item.image_small} width="100"/></td>
                        <td><a href={"/item/" + item.slug}>{item.name}</a></td>
                        <td>{item.price} грн</td>
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

    removeItem(id){
        this.props.tasksAction.remove(id)
        this.props.tasksAction.get()
    }
}
CheckoutFormContainer.propTypes = {}
export default CheckoutFormContainer
