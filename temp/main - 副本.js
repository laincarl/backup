
var Button = ReactBootstrap.Button;
var ButtonToolbar = ReactBootstrap.ButtonToolbar;
var Navbar = ReactBootstrap.Navbar;
var NavItem = ReactBootstrap.NavItem;
var NavDropdown = ReactBootstrap.NavDropdown;
var MenuItem = ReactBootstrap.MenuItem;
var Nav = ReactBootstrap.Nav;
var FormGroup = ReactBootstrap.FormGroup;
var FormControl = ReactBootstrap.FormControl;
var Image = ReactBootstrap.Image;
var Grid = ReactBootstrap.Grid;
var Col = ReactBootstrap.Col;
var Row = ReactBootstrap.Row;
var Media = ReactBootstrap.Media;
var InputGroup = ReactBootstrap.InputGroup;
//alert(ReactBootstrap);

const navbarInstance = (
<Navbar inverse collapseOnSelect>
    <Navbar.Header>
      <Navbar.Brand>
        <a href="/index.html">首页</a>
      </Navbar.Brand>
      <Navbar.Toggle />
    </Navbar.Header>
   <Navbar.Collapse>
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
        <Nav pullRight>
        <Navbar.Form>
           <FormGroup>
                <InputGroup>        
                    <FormControl type="text" />
                    <InputGroup.Button><Button bsStyle="primary">搜索</Button>
                    </InputGroup.Button>
                </InputGroup>
            </FormGroup>        
        <Image width={45} height={45} src="head.jpg" circle /> 
      </Navbar.Form>
        
      </Nav>
      
    </Navbar.Collapse>
  </Navbar>
);

const imageShapeInstance = (
<Grid>
    <Row>
      <Col xs={6} md={4}>
        <Image src="head.jpg" rounded responsive/>
      </Col>
      <Col xs={6} md={4}>
        <Image src="head.jpg" circle responsive />
      </Col>
      <Col xs={6} md={4}>
        <Image src="head.jpg" thumbnail responsive />
      </Col>
    </Row>
  </Grid>
);
ReactDOM.render(navbarInstance, document.getElementById('media'));
//ReactDOM.render(mediaListInstance, document.getElementById('pic'));