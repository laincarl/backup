import React from 'react';
import ReactDOM from 'react-dom';
import PropTypes from 'prop-types';
import registerServiceWorker from './registerServiceWorker';
import './index.css';
class Index extends React.Component {
    static childContextTypes={
        name: PropTypes.string,
        change: PropTypes.func
    }
    constructor() {
        super();
        this.state = {
            name: "wang"
        }
    }
    Change(obj) {
        this.setState(obj)
    //console.log(this.context.name);
    }
    componentDidMount() {}
    getChildContext() {
        return {
            name: this.state.name,
            change: this.Change.bind(this)
        }
    }
    render() {
        return <div><Title/><Content/></div>
    }
}
class Title extends React.Component {
    static contextTypes={
        name: PropTypes.string,
        change: PropTypes.func
    }
    componentWillMount() {}
    changeContext() {
        //this.context.name = 'ss';
        this.context.change({
            name: 'ss'
        });
    }
    render() {
        return <div>{this.context.name}<button onClick={this.changeContext.bind(this)}>change</button></div>
    }
}
class Content extends React.Component {
    static contextTypes={
        name: PropTypes.string
    }
    componentWillMount() {
        //console.log(this.context.name);
    }
    show() {
        console.log(this.context.name);
    }
    render() {
        return <div>{this.context.name}<button onClick={this.show.bind(this)}>show</button></div>
    }
}
ReactDOM.render(<Index/>, document.getElementById('root'));
registerServiceWorker();
