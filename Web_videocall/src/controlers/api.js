const PROJECT_ID = "SKIuNgIgQclWM0GFSPCJO7eervWS7hKkQg";
const PROJECT_SECRET = "Tk1NaUZGVElWZ3VpNFZVQlZVVTZseWFsWTlHTndyMw==";
const BASE_URL = "https://api.stringee.com/v1/room2";

class API {
  constructor(projectId, projectSecret) {
    this.projectId = projectId;
    this.projectSecret = projectSecret;
    this.restToken = "";
  }

  async createRoom() {
    const roomName = Math.random().toFixed(4);
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
    console.log({ room });
    return room;
  }

  async listRoom() {
    const response = await axios.get(`${BASE_URL}/list`, {
      headers: this._authHeader()
    });

    const rooms = response.data.list;
    console.log({ rooms });
    return rooms;
  }
  
  async deleteRoom(roomId) {
    const response = await axios.put(`${BASE_URL}/delete`, {
      roomId
    }, {
      headers: this._authHeader()
    })
    
    console.log({response})
    
    return response.data;
  }
  
  async clearAllRooms() {
    const rooms = await this.listRoom()
    const response = await Promise.all(rooms.map(room => this.deleteRoom(room.roomId)))
    
    return response;
  }

  async setRestToken() {
    const tokens = await this._getToken({ rest: true });
    const restToken = tokens.rest_access_token;
    this.restToken = restToken;

    return restToken;
  }

  async getUserToken(userId) {
    const tokens = await this._getToken({ userId });
    return tokens.access_token;
  }

  async getRoomToken(roomId) {
    const tokens = await this._getToken({ roomId });
    return tokens.room_token;
  }

  async _getToken({ userId, roomId, rest }) {
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

const api = new API(PROJECT_ID, PROJECT_SECRET);
