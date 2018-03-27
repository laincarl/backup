import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import registerServiceWorker from './registerServiceWorker';
import './index.css';
import { Navbar } from 'react-bootstrap';
import { NavItem } from 'react-bootstrap';
import { NavDropdown } from 'react-bootstrap';
import { Nav } from 'react-bootstrap';
import { MenuItem } from 'react-bootstrap';
import { FormGroup } from 'react-bootstrap';
import { FormControl } from 'react-bootstrap';
import { Button } from 'react-bootstrap';

const navbarInstance = (
<Navbar inverse collapseOnSelect>
    <Navbar.Header>
      <Navbar.Brand>
        <a href="/index">首页</a>
      </Navbar.Brand>
      <Navbar.Toggle />
    </Navbar.Header>
   
      <Nav>
        <NavItem eventKey={1} href="#">Link</NavItem>
        <NavItem eventKey={2} href="#">Link</NavItem>
        <NavDropdown eventKey={3} title="Dropdown" id="basic-nav-dropdown">
          <MenuItem eventKey={3.1}>Action</MenuItem>
          <MenuItem eventKey={3.2}>Another action</MenuItem>
          <MenuItem eventKey={3.3}>Something else here</MenuItem>
          <MenuItem divider />
          <MenuItem eventKey={3.3}>Separated link</MenuItem>
        </NavDropdown>
      </Nav>
      <Navbar.Form pullRight>
        <FormGroup>
          <FormControl type="text" placeholder="Search" />
        </FormGroup>
        {' '}
        <Button type="submit">Submit</Button>
      </Navbar.Form>
    
  </Navbar>
);

ReactDOM.render(navbarInstance, document.getElementById('root'));



//ReactDOM.render(<App />, document.getElementById('root'));
registerServiceWorker();
