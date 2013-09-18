var TILE_WIDTH = 10;
var TILE_HEIGHT = 10;
var MAP_WIDTH = 800;
var MAP_HEIGHT = 600;
var MAX_ROOMS = 30;
var MAX_ROOM_SIZE = 20;
var MIN_ROOM_SIZE = 5;

function Map() {
	this.rooms = [];
}

function Point(x, y) {
	this.x = x;
	this.y = y;
}

function Room(x, y, w, h) {
	this.x1 = x;
	this.x2 = x + w;
	this.y1 = y;
	this.y2 = y + h;
	this.x = x * TILE_WIDTH;
	this.y = y * TILE_HEIGHT;
	this.w = w;
	this.h = h;
	this.center = Point(Math.floor((x1 + x2) / 2), Math.floor((y1 + y2) / 2));
}

Room.prototype.intersects = function(room) {
	return (x1 <= room.x2 && x2 >= room.x1 && y1 <= room.y2 && y2 >= room.y1);
};

function place_rooms() {
	var rooms = [];
	
	var new_center = null;
	
	for(var i = 0; i < MAX_ROOMS; i++)
	{
		var w = MIN_ROOM_SIZE + Math.random(MAX_ROOM_SIZE - MIN_ROOM_SIZE + 1);
		var h = MIN_ROOM_SIZE + Math.random(MAX_ROOM_SIZE - MIN_ROOM_SIZE + 1);
		var x = Math.random(MAP_WIDTH - w - 1) + 1;
		var y = Math.random(MAP_HEIGHT - h - 1) + 1;
		
		var new_room = new Room(x, y, w, h);
		
		var success = true;
		
		for(var j = 0; j < rooms.length; j++)
		{
			if(newRoom.intersects(rooms[j]))
			{
				success = false;
				break;
			}
		}
		
		if(success)
		{
			createRoom(newRoom);
			
			rooms.push(newRoom);
		}
	}
}

function h_corridor(x1, x2, y) {
	for(var x = Math.min(x1, x2); x < (Math.max(x1, x2) + 1); x++)
	{
		map[x][y].
	}
}

function v_corridor(y1, y2, x) {
	
}
