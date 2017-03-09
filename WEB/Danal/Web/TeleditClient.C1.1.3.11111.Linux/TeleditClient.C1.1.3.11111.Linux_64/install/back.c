/**
 *
 *
 */
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include "bcdsclient.h"
#include "wsafunc.h"

char filename[32] = "./teledit.conf";	// ȯ�� ���� 

int main(int argc, char **argv){
	int ret;
	int sock = -1;
	int result;			// response result
	int TIMEOUT_LIMIT = 20;		// ���� ���ð� (Minimum 20 seconds)
	int key_seq;
	int start_t;
	char errmsg[1024];
	char resmsg[1024];
	char inputstr[1024];
	char tid[20];
	char value[128];				// parsing �ϱ� ���� ���Ǵ� temp ����
	int optionfailure;

	WORD wVersionRequested;
	WSADATA wsaData;

	wVersionRequested = MAKEWORD(2, 0);

	if (WSAStartup(wVersionRequested, &wsaData)){
		printf("WSAStartup Failed\n");
		return -1;
	}

	// ȯ�� ������ ���Ͽ� Option�� �о� �ɴϴ�.
	optionfailure = InitializeOption(filename, errmsg);

	memset(inputstr, 0x00, sizeof(inputstr));
	if(argc >= 2) strcpy(inputstr, argv[1]);

	// ������ ���� ��û�� �ϰ� CP ������ �޽��ϴ�.
	if((ret = BindForBillReport(&sock, inputstr, &key_seq, errmsg, optionfailure)) < 0){
		// connection error or bind error
		issocketclose(sock);
		WSACleanup();

		printf("Error : %s\n", errmsg);	// print error reason.

		return -1;
	}

	start_t = time(NULL);
	while(1){
		if(time(NULL) - start_t > 2 * TIMEOUT_LIMIT){	// ���� �ð� ���� ������ ������ ���� �ʴ� ���
			issocketclose(sock);
			WSACleanup();
			return -1;

		}

		// �����κ��� ����Ÿ�� ��ٸ��ϴ�.
		if((ret = GetRBR(sock, TIMEOUT_LIMIT, key_seq, resmsg, errmsg)) < 0){
			switch(ret){
				case -1:	// Network error
					issocketclose(sock);
					WSACleanup();
					printf("Error : %s\n", errmsg);	// print error reason.
					return -1;
				case -2:	// Response timeout.
					// �ܼ� Ÿ�Ӿƿ����� ������ ping�� ������ check�մϴ�.
					if((ret = SendRBPR(sock, key_seq, errmsg)) < 0){
						issocketclose(sock);
						WSACleanup();
						printf("Error : %s\n", errmsg);	// print error reason.
						return -1;
					}

					start_t = time(NULL);
					continue;
				default:	// No case
					break;
			}
		}
		start_t = time(NULL);

		if((ret = d4g_str_getpacketstring(resmsg, "Command", ";", "=", sizeof(value), value, errmsg)) < 0){
			// Parsing error
			printf("Error : %s\n", errmsg);
			issocketclose(sock);
			WSACleanup();
			return ret;
		}
		if(strcmp(value, "BILL_REPORT")) continue;	// �����κ��� bill report message�� �ƴ� ��� ����

		// Response message parsing.
		if((ret = d4g_str_getpacketstring(resmsg, "Result", ";", "=", sizeof(value), value, errmsg)) < 0){
			// Parsing error
			printf("Error : %s\n", errmsg);
			issocketclose(sock);
			WSACleanup();
			return ret;
		}

		if((result = atoi(value)) != 0){
			// ������ ������ ������ �ƴ� ���.
			if((ret = d4g_str_getpacketstring(resmsg, "ErrMsg", ";", "=", sizeof(value), value, errmsg)) < 0){
				// Parsing error
				printf("Error : %s\n", errmsg);
				issocketclose(sock);
				WSACleanup();
				return ret;
			}
			printf("Response Error : %d %s\n", result, value);
			issocketclose(sock);
			WSACleanup();
			return ret;
		}

		if((ret = d4g_str_getpacketstring(resmsg, "TID", ";", "=", sizeof(tid), tid, errmsg)) < 0){
			// Parsing error
			printf("Error : %s\n", errmsg);
			issocketclose(sock);
			WSACleanup();
			return ret;
		}
		/************************************************************************************************
		 *
		 * Add code here...
		 *
		 * ���������� ���ϵ� ����Ÿ�� ó���ϴ� ���Դϴ�.
		 * parsing �� TID�� �̿��Ͽ� DB ó���� �ϸ� �˴ϴ�.
		 * d4g_str_getpacketstring �Լ��� �̿��Ͻø� ���� parsing �� �� ����ϴ�.
		 * ���������� DB ó���� �Ϸ� �Ǹ�, SendRBRA�� �̿��Ͽ� Server�� ����Ÿ ó�� �Ϸ� �뺸 �մϴ�.
		 *
		 * *********************************************************************************************/

		if((ret = SendRBRA(sock, key_seq, tid, errmsg)) < 0){
			issocketclose(sock);
			WSACleanup();
			printf("Error : %s\n", errmsg);
			return ret;
		}
	}
}
