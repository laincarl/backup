import React from "react";
import ReactDOM from "react-dom";
import "./index.css";
import registerServiceWorker from "./registerServiceWorker";
var Component = React.Component;
const propTypes = {
  id: propTypes.number.isRequired
};
const defaultProps = {
  id: 5
};
Father.propTypes = propTypes;
Father.defaultProps = defaultProps;
class Father extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      aa: ["a", "b", "c", "d"]
    };
    console.log("constructor");
  }
  componentWillMount() {
    console.log("will mount");
  }

  componentDidMount() {
    console.log("did mount");
  }

  componentWillReceiveProps(nextProps) {
    console.log("will recprop");
  }

  // shouldComponentUpdate(nextProps, nextState) {
  //     console.log("should update")

  // }

  componentWillUpdate(nextProps, nextState) {
    console.log("will update");
  }

  componentDidUpdate(prevProps, prevState) {
    console.log("did update");
  }

  componentWillUnmount() {
    console.log("will unmount");
  }
  handleClick() {
    this.state.aa.splice(0, 1);
    this.setState({
      aa: this.state.aa
    });
  }
  render() {
    return (
      <div>
        {this.state.aa.map((con, i) => <Child key={con + i} data={con} />)}
        <button onClick={this.handleClick.bind(this)}>ss</button>
      </div>
    );
  }
}
class Child extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      data: this.props.data
    };
  }

  render() {
    return <div>{this.state.data}</div>;
  }
}

class componentName extends Component {
  constructor(props) {
    super(props);
  }

  componentWillMount() {
    console.log("will mount");
  }

  componentDidMount() {
    console.log("did mount");
  }

  componentWillReceiveProps(nextProps) {
    console.log("will recprop");
  }

  shouldComponentUpdate(nextProps, nextState) {
    console.log("should update");
  }

  componentWillUpdate(nextProps, nextState) {
    console.log("will update");
  }

  componentDidUpdate(prevProps, prevState) {
    console.log("did update");
  }

  componentWillUnmount() {
    console.log("will unmount");
  }

  render() {
    return <div />;
  }
}

ReactDOM.render(<Father />, document.getElementById("root"));
registerServiceWorker();
