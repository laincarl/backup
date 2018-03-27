import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import registerServiceWorker from './registerServiceWorker';
import './index.css';


class Container extends React.Component {
    constructor() {
        super()
        this.state = {
            total: [],
            totalnum: 20,
            prev: 0,
            current: 0,
            children: []
        }
        //生成一个数组，用来生成页数元素
        for (let i = 1; i <= this.state.totalnum; i++)
            this.state.total.push(i);
    }
    componentDidMount() {
        this.state.children[this.state.current].select();
    }
    //在state都更新完毕后，将当前元素选中，将之前元素取消选中
    componentDidUpdate() {
        this.state.children[this.state.prev].unselect();
        this.state.children[this.state.current].select();
        var ele=document.querySelector(".pagenum-container");
        ele.scrollLeft=80*this.state.current;
    }
    //上一个
    pre() {
        //将prev设置为当前，如果当前元素是第一个，就将current设置为最后一个，否则current减一
        if (this.state.current === 0) {
            this.setState({
                prev: this.state.current,
                current: this.state.totalnum - 1
            })
        } else {
            this.setState({
                prev: this.state.current,
                current: this.state.current - 1
            })
        }
    }
    //下一个
    next() {
        //将prev设置为当前，如果当前元素是最后一个，就将current设置为第一个，否则current加一
        if (this.state.current + 1 === this.state.totalnum) {
            this.setState({
                prev: this.state.current,
                current: 0
            })
        } else {
            this.setState({
                prev: this.state.current,
                current: this.state.current + 1
            })
        }
        
    }
    //接受子元素传来的this，也就是子元素自身
    childmanage(child) {
        console.log(child);
        //将子元素传来的this与children里的元素匹配，找到点击的元素
        var index = this.state.children.indexOf(child);
        console.log(index);
        this.setState({
            prev: this.state.current,
            current: index
        })
    }
    render() {
        //使用ref存放子元素引用
        return <div className="page-container">
        <button onClick={this.pre.bind(this)}>上一页</button>
        <div className="pagenum-container">        
		{this.state.total.map((v, i) => <One ref={(ref) => this.state.children[i] = ref} childmanage={this.childmanage.bind(this)} pagenum={v}/>)}
        </div>
        <button onClick={this.next.bind(this)}>下一页</button>
        </div>
    }
}
class One extends React.Component {
    constructor() {
        super()
        this.state = {
            select: false,
            selectStyle: {
                'background': 'red'
            }
        }

    }

    select() {
        this.setState(
            {
                select: true
            })
    }
    unselect() {
        this.setState(
            {
                select: false
            })
    }
    manage() {
        //将自身传给父元素
        this.props.childmanage(this);
    }
    render() {
        return <span className="item" onClick={this.manage.bind(this)} style={this.state.select ? this.state.selectStyle : null}>{this.props.pagenum}</span>
    }
}

ReactDOM.render(<Container />, document.getElementById('root'));
registerServiceWorker();
