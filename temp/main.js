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
    // static defaultProps = {
    //     comments: []
    // }
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
ReactDOM.render(<CommentApp/>, document.getElementById('media'));