import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import registerServiceWorker from './registerServiceWorker';
import './index.css';
import Pro from './province.js'
Pro.provinces.map(function(ss) {
    console.log(ss.provinceName)
    console.log(ss.citys)
});

class ProvinceContainer extends React.Component {

    render() {
        return <div className="province-container">{Pro.provinces.map((proinfo, i) => <Province province={proinfo.provinceName} citys={proinfo.citys} key={i}/>)}</div>;
    }
}
class Province extends React.Component {

    render() {
        return <div className = "province"><div>{this.props.province}</div><CityContainer citys={this.props.citys}/></div>;
    }
}
class CityContainer extends React.Component {
    render() {
        return <div className="city-container">{this.props.citys.map((city, i) => <City city={city.citysName}/>)}</div>
    }
}
class City extends React.Component {
    render() {
        return <div className="city">{this.props.city}</div>
    }
}

class Nav extends React.Component {
    render() {
        return (<div className="nav-container">
        	<div className="nav-left-container clearfix">
        	</div>
        	<div className="nav-right-container clearfix">
        	</div>
        	</div>);
    }
}
class CommentApp extends React.Component {
    constructor() {
        super();
        this.state = {
            comments: []
        }
    }
    componentWillMount() {
        console.log('will');
    }
    componentDidMount() {
        console.log('did');
    }
    handleCommentSubmmit(comment) {
        console.log(comment);
        if (!comment) return
        if (!comment.username) return alert('请输入用户名')
        if (!comment.content) return alert('请输入评论内容')
        this.state.comments.push(comment)
        this.setState({
            comments: this.state.comments
        })
    }
    render() {
        return (
            <div className='wrapper'>
            <CommentInput onSubmit={this.handleCommentSubmmit.bind(this)}/>
            <CommentList comments={this.state.comments}/>
            </div>
        );
    }
}
class CommentInput extends React.Component {
    constructor() {
        super();
        this.state = {
            username: '',
            content: ''
        }
    }
    handleUsernameChange(event) {
        this.setState({
            username: event.target.value
        });
    }
    handleContentChange(event) {
        this.setState({
            content: event.target.value
        });
    }
    handleSubmmit() {
        if (this.props.onSubmit) {
            const {username, content} = this.state;
            this.props.onSubmit({
                username,
                content
            });
        }
    }
    render() {
        return (
            <div>
            <div>
            <span>用户名：</span>
            <input value={this.state.username} onChange={this.handleUsernameChange.bind(this)}/>
            </div>
            <div>
            <span>内容：</span>
            <textarea value={this.state.content} onChange={this.handleContentChange.bind(this)}/>
            </div>
            <button onClick={this.handleSubmmit.bind(this)}>提交</button>
            </div>
        );
    }
}
class CommentList extends React.Component {
    // constructor(props) {
    //     super(props);

    // }
    static defaultProps = {
        comments: []
    }
    render() {

        return (
            <div>{this.props.comments.map((comment, i) => <Comment comment={comment} key={i}/>)}</div>
        );
    }
}
class Comment extends React.Component {
    render() {
        return (
            <div><span>{this.props.comment.username}</span><p>{this.props.comment.content}</p></div>
        );
    }
}
ReactDOM.render(<ProvinceContainer/>, document.getElementById('root'));

registerServiceWorker();
