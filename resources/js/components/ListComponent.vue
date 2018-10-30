<template>
	<div class="col-md-12">
			<div class="card">
					<div class="card-header">
						<ul class="nav nav-pills float-left">
							<li class="nav-item">
								<a class="nav-link" v-bind:class="{ active: filter == 'all' }" v-on:click="filterList('all')">All</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" v-bind:class="{ active: filter == 'active' }" v-on:click="filterList('active')">Active</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" v-bind:class="{ active: filter == 'inactive' }" v-on:click="filterList('inactive')">Inactive</a>
							</li>
						</ul>
						<button class="btn btn-info float-right" v-on:click="openModal()">+ Add Widget</button>
					</div>
					<div class="card-body">
						<table class="table" id="list">
								<thead>
									<tr>
										<th>Name</th>
										<th>Description</th>
										<th>Code</th>
										<th colspan="2">Status</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="widget in widgets" :key="widget.id">
											<td>{{ widget.name }}</td>
											<td>{{ widget.description }}</td>
											<td>{{ widget.code }}</td>
											<td>{{ widget.status | capitalize }}</td>
											<td class="action"><button type="button" class="btn btn-sm btn-outline-secondary" v-on:click="openModal(widget)">Edit</button></td>
									</tr>
									<tr v-if="widgets.length == 0">
										<td colspan="5">No widgets found. Create one!</td>
									</tr>
								</tbody>
						</table>
					</div>
			</div>
			<div id="widget-modal" class="modal" @click.self="closeModal(widget)">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" v-if="widget.name">{{ widget.name }}</h5>
							<h5 class="modal-title modal-title-light" v-if="! widget.name">New Widget</h5>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" class="form-control" id="name" name="name" v-model="widget.name" v-on:input="validateInput(widget)">
								</div>
								<div class="form-group">
									<label for="description">Description</label>
									<textarea class="form-control" id="description" name="description" v-model="widget.description" v-on:input="validateInput(widget)"></textarea>
								</div>
								<div class="form-group">
									<label for="code">Code</label>
									<textarea class="form-control" id="code" name="code" v-model="widget.code" v-on:input="validateInput(widget)"></textarea>
								</div>
								<div class="form-group">
									<label for="status">Status</label>
									<select id="status" name="status" class="custom-select" v-model="widget.status" v-on:input="validateInput(widget)">
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div>
							</form>
							<div v-if="widget.id" class="uuid">UUID: <strong>{{ widget.id }}</strong></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger mr-auto" v-on:click="deleteWidget(widget)">Delete</button>
							<button type="button" class="btn btn-secondary" v-on:click="closeModal(widget)">Close</button>
							<button type="button" class="btn btn-primary" v-bind:class="{ disabled: ! inputValid }" v-if="! widget.id" v-on:click="createWidget(widget)">Create</button>
							<button type="button" class="btn btn-primary" v-bind:class="{ disabled: ! inputValid }" v-if="widget.id" v-on:click="updateWidget(widget)">Update</button>
						</div>
					</div>
				</div>
			</div>
	</div>
</template>

<script>
		import axios from 'axios';

    export default {
			data() {
				return {
					filter: 'all',
					inputValid: false,
					properties: ['name', 'description', 'code', 'status'],
					widgets_unfiltered: [],
					widget: {},
				}
			},
			computed: {
				widgets: function() {
					var self = this;
					if (self.filter == 'all') {
						return self.widgets_unfiltered;
					} else {
						var filtered = [];
						self.widgets_unfiltered.forEach(function(widget) {
							if (widget.status == self.filter) {
								filtered.push(widget);
							}
						});
						return filtered;
					}
				},
			},
			methods: {
				getWidgets: function() {
					axios.get('/api/widget')
					.then((response) => {
						this.widgets_unfiltered = response.data.data;
					})
				},
				filterList: function(type) {
					this.filter = type;
					this.$forceUpdate();
				},
				validateInput: function(widget) {
					var self = this;
					Vue.nextTick(function () {
						self.inputValid = true;
						self.properties.forEach(function(property) {
							if (! widget[property]) self.inputValid = false;
						});
					});
				},
				createWidget: function(widget) {
					axios.post('/api/widget', widget)
					.then((response) => {
						$('#widget-modal').modal('hide');
						this.widget = response.data.data;
						this.widgets_unfiltered.push(this.widget);
						if (this.filter !== 'all') this.filterList(this.widget.status);
					})
				},
				updateWidget: function(widget) {
					axios.put('/api/widget/' + widget.id, widget)
					.then((response) => {
						$('#widget-modal').modal('hide');
						this.widget = response.data.data;
						if (this.filter !== 'all') this.filterList(this.widget.status);
					})
				},
				deleteWidget: function(widget) {
					var didConfirm = confirm('Are you sure you want to delete ' + widget.name + '?');
					if (didConfirm) {
						axios.delete('/api/widget/' + widget.id)
						.then((response) => {
							$('#widget-modal').modal('hide');
							this.widgets_unfiltered = response.data.data;
						})
					}
				},
				openModal: function(widget) {
					this._beforeEditingCache = Object.assign({}, widget);
					if (widget === undefined) {
						this.widget = {};
					} else {
						this.widget = widget;
					}
					this.validateInput(this.widget);
					Vue.nextTick(function () {
						$('#widget-modal').modal('show');
					})
				},
				closeModal: function(widget) {
					$('#widget-modal').modal('hide');
					Object.assign(widget, this._beforeEditingCache);
				}
			},
			mounted() {
				this.getWidgets();
			},
			filters: {
			  capitalize: function (value) {
			    if (!value) return ''
				    value = value.toString()
				    return value.charAt(0).toUpperCase() + value.slice(1)
			  }
			}
    }
</script>
