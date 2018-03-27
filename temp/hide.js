class Title extends React.Component {
    render() {
        return (
            <h1>标题</h1>
        );
    }
}
class Con extends React.Component {
    constructor() {
        super();
        this.state = {
            hide: false
        }
    }
    handleclick() {
        this.setState({
            hide: !this.state.hide
        });
    }
    render() {
        return (
            <div>
            {this.state.hide ? null : <Title/>}
            <button onClick={this.handleclick.bind(this)}>col</button>
            </div>
        );
    }
}
ReactDOM.render(<Con/>, document.getElementById('media'));