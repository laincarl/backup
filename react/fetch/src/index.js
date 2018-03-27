import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import 'isomorphic-fetch';
import 'es6-promise';
import registerServiceWorker from './registerServiceWorker';
class Main extends React.Component {
    constructor(props) {
        super(props);

        this.state = {};

    }
    componentDidMount() {
        var result = fetch("../../php/get_company_positioninfos.php", {
            method: "POST",
            headers: {
                'Accept': 'application/json',
            },
            body: "CIID=2"
        });
        result.then((res) => res.json()).then((json) => console.log(json))
    }

    render() {
        return (
            <div>
            </div>
            );
    }
}

ReactDOM.render(<Main />, document.getElementById('root'));
registerServiceWorker();
