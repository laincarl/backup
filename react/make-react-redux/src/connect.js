import React, { Component, PropTypes } from 'react'

const connect = (WrappedComponent) => {
    class Connect extends Component {
        static contextTypes={
            store: PropTypes.object
        }
        render() {
            return <WrappedComponent/>
        }
    }
    return Connect;
}

export default connect