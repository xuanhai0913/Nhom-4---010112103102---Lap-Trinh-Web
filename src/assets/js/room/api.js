const PROJECT_ID = "SK.0.ysYMtVtgRe3X0l6PHYcEb2aZRh6XB3U";
const PROJECT_SECRET = "UDhxOFp1aUdwNjZ2ZU52OXJhU3RWVUprazBaY3pMZDI=";
const BASE_URL = "https://api.stringee.com/v1/room2";

class API {
  constructor(projectId, projectSecret) {
    this.projectId = projectId;
    this.projectSecret = projectSecret;
    this.restToken = "";
  }

  async createRoom() {
    const roomName = Math.random().toFixed(4); // Room name is random for demonstration
    try {
      const response = await axios.post(
        `${BASE_URL}/create`,
        {
          name: roomName,
          uniqueName: roomName
        },
        {
          headers: this._authHeader()
        }
      );
  
      const room = response.data;
      if (room && room.roomId) {
        console.log({ room });
        // Redirect to room.php with the generated roomId in the desired format
        window.location.href = `/room?room=${room.roomId}`;
        return room;
      } else {
        console.error('Failed to create room, roomId missing');
        return null;
      }
    } catch (error) {
      console.error('Error creating room:', error);
      return null;
    }
  }
  

  async listRoom() {
    try {
      const response = await axios.get(`${BASE_URL}/list`, {
        headers: this._authHeader()
      });

      const rooms = response.data.list;
      console.log({ rooms });

      // Dynamically create the list of rooms with "Join" buttons
      let roomListHtml = '';
      rooms.forEach(room => {
        roomListHtml += `
          <div>
            <span>Room ID: ${room.roomId}</span>
            <button onclick="joinRoom('${room.roomId}')">Join Room</button>
          </div>
        `;
      });

      // Display the rooms and their corresponding join buttons
      document.getElementById('roomList').innerHTML = roomListHtml;
      return rooms;
    } catch (error) {
      console.error('Error listing rooms:', error);
      return [];
    }
  }

  async deleteRoom(roomId) {
    try {
      const response = await axios.put(`${BASE_URL}/delete`, {
        roomId
      }, {
        headers: this._authHeader()
      });

      console.log({ response });
      return response.data;
    } catch (error) {
      console.error('Error deleting room:', error);
      return null;
    }
  }

  async clearAllRooms() {
    try {
      const rooms = await this.listRoom();
      const response = await Promise.all(rooms.map(room => this.deleteRoom(room.roomId)));
      return response;
    } catch (error) {
      console.error('Error clearing rooms:', error);
      return [];
    }
  }

  async setRestToken() {
    try {
      const tokens = await this._getToken({ rest: true });
      const restToken = tokens.rest_access_token;
      this.restToken = restToken;

      return restToken;
    } catch (error) {
      console.error('Error setting rest token:', error);
      return null;
    }
  }

  async getUserToken(userId) {
    try {
      const tokens = await this._getToken({ userId });
      return tokens.access_token;
    } catch (error) {
      console.error('Error getting user token:', error);
      return null;
    }
  }

  async getRoomToken(roomId) {
    try {
      const tokens = await this._getToken({ roomId });
      return tokens.room_token;
    } catch (error) {
      console.error('Error getting room token:', error);
      return null;
    }
  }

  async _getToken({ userId, roomId, rest }) {
    try {
      const response = await axios.get(
        "https://v2.stringee.com/web-sdk-conference-samples/php/token_helper.php",
        {
          params: {
            keySid: this.projectId,
            keySecret: this.projectSecret,
            userId,
            roomId,
            rest
          }
        }
      );

      const tokens = response.data;
      console.log({ tokens });
      return tokens;
    } catch (error) {
      console.error('Error getting token:', error);
      return {};
    }
  }

  isSafari() {
    const ua = navigator.userAgent.toLowerCase();
    return !ua.includes('chrome') && ua.includes('safari');
  }

  _authHeader() {
    return {
      "X-STRINGEE-AUTH": this.restToken
    };
  }
}

// Create an instance of API
const api = new API(PROJECT_ID, PROJECT_SECRET);

// Join room function (called when the user clicks a "Join Room" button)
function joinRoom(roomId) {
  // Redirect user to the room with the specified roomId
  window.location.href = `/room?room=${roomId}`;
}
