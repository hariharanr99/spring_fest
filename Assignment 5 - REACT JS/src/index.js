import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import registerServiceWorker from './registerServiceWorker';
var createReactClass = require('create-react-class');

var num = -1,cnum = -1;

var Listitem = createReactClass({
	getInitialState: function () {
		return {editon: false}
	},
	deletetask: function() {
		this.refs.item.style.animation = "deleting 1s";
		var listarray = this.props.thearr;
		var newarr = [];
		for(var i=0;i<listarray.length;i++) {
			if(listarray[i]===this.props.children) {document.getElementsByClassName('dot')[i].style.animation = "zoomrev 1s ease-in";
			break; }
		}
		num = num-1;
        setTimeout(() => {
			for(var i=0;i<listarray.length;i++)
			    if(listarray[i]!==this.props.children) newarr.push(listarray[i]);        
			this.props.thelist.setState({listarr: newarr, normal: true});
        }, 1000);
    },
	updateedit: function() {
		this.refs.item.style.background = "rgba(0,0,0,0.6)";
		var listarray = this.props.thearr;
		var newarr = [];
		for(var i=0;i<listarray.length;i++) {
		    if(listarray[i]!==this.props.children) newarr.push(listarray[i]);
		    else newarr.push(this.refs.editted.value)
		}
		this.setState({editon: false});
		this.props.thelist.setState({listarr: newarr});
	},
	edittask: function() {
		this.refs.item.style.background = "rgba(0,0,0,0.5)";
		this.setState({editon: true});
	},
	editnormal: function() {
		this.refs.item.getElementsByTagName('img')[0].setAttribute("src","edit.png");
	},
	edithover: function() {
		this.refs.item.getElementsByTagName('img')[0].setAttribute("src","edithover.png");
	},
	deletenormal: function() {
		this.refs.item.getElementsByTagName('img')[1].setAttribute("src","delete.png");
	},
	deletehover: function() {
		this.refs.item.getElementsByTagName('img')[1].setAttribute("src","deletehover.png");
	},
	render: function() {
		if(this.state.editon) {
			//this.refs.item.getElementsByTagName('input')[0].focus();
			return (
				<div ref="item" className = "listitems" style= {this.props.stylecss}>
					<input type="text" ref="editted" defaultValue={this.props.children}/>
					<img className = "deleteimg" onClick={this.updateedit} src="saveedit.png"/>
				</div>
			);
		}
		else {
			return (
				<div ref="item" className = "listitems" style= {this.props.stylecss}>
					<label className="listtext">{this.props.children}</label>
					<img className = "editimg" onClick={this.edittask} onMouseEnter={this.edithover} onMouseLeave={this.editnormal} src="edit.png"/>
					<img className = "deleteimg" onClick={this.deletetask} onMouseEnter={this.deletehover} onMouseLeave={this.deletenormal} src="delete.png"/>
				</div>
			);
		}
	}
});

var List = createReactClass({
	getInitialState: function() {
		return {
			listarr: [],
			completed: [],
			tobeadded: false,
			normal: false
		}
	},
	addtask: function() {
		if(document.getElementById('add').getElementsByTagName('input')[0].value.length !== 0) {
			var newarr = this.state.listarr.slice();
			var text = document.getElementById('add').getElementsByTagName('input')[0].value;
			var listarray = this.state.listarr;
			var exist = false;
			for(var i=0;i<listarray.length;i++) {
			    if(listarray[i]===text) exist = true;
			}

			if(!exist) {
				document.getElementById('add').getElementsByTagName('input')[0].value = "";
				num = num+1;
				newarr.push(text);
				this.setState({listarr: newarr, tobeadded: true, normal: false});
				exist = false;
			}
			else {
				document.getElementById('add').getElementsByTagName('input')[0].value = "";
				alert("Please check! It is already added"); 
			}
		}
		else alert('Field cannot be empty');
	},
	addnormal: function() {
		document.getElementById('add').getElementsByTagName('img')[0].style.transform = "none";
	},
	addhover: function() {
		document.getElementById('add').getElementsByTagName('img')[0].style.transform = "rotateZ(90deg)";
	},
	render: function() {
		var array = this.state.listarr;
		var list = this;
		var normal = this.state.normal;
		if(this.state.tobeadded) {
			return (<div>
				<div id="add">
					<input placeholder="Add to list..." type="text"/>
					<img onClick={this.addtask} onMouseEnter={this.addhover} onMouseLeave={this.addnormal} src="addbutton.png"/>
				</div>
				{
					this.state.listarr.map(function(listitem, i) {
						var style = {top: 37+(6.7*i)+'vh', marginBottom: '10vh'};
						var dotstyle = {top: 38.8+(6.7*i)+'vh'};
					
						if(i !== num || normal) {
							style = {top: 37+(6.7*i)+'vh', marginBottom: '10vh', animation: 'none'};
							dotstyle = {top: 38.7+(6.7*i)+'vh', animation: 'none'};
						}
						return (<div key={i}>
							<Listitem key={i} ref="item" stylecss={style} thearr={array} thelist={list}>{listitem}</Listitem>
							<div ref="dots" className="dot" style = {dotstyle}><img src="pointer.png" /></div>
						</div>)
					})

				}
			</div>);
		}
		else {
			return (<div>
				<div id="add">
					<input placeholder="Add to list..." type="text"/>
				<img onClick={this.addtask} onMouseEnter={this.addhover} onMouseLeave={this.addnormal} src="addbutton.png"/>
				</div>
			</div>);
		}
	}
});

ReactDOM.render(<div>
	<div id="header">MY TO-DO LIST</div>
	<List />
	</div>
, document.getElementById('root'));
registerServiceWorker();
